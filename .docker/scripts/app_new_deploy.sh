#!/bin/bash
set -e

#echo "starting" > /locks/status
PWD=$(pwd)
WAIT_AFTER_CONNECT=0

# Set ENV for cron (AND ANOTHER???)
printenv | sed 's/^\(.*\)$/export \1/g' | grep -v PHP | grep -v "affinity" | grep -v "GPG_KEYS" > /root/project_env.sh

# Доустановка composer пакетов (TRACEWAY-7109)
echo ">>> Install composer packages"

if ! [[ "$IS_STAGE_ENV" == "true" ]] && ! [[ "$IS_TEST_ENV" == "true" ]] && ! [[ "$IS_LOCAL_ENV" == "true" ]]; then
    COMPOSER_DEV_PACKAGES_ARG=" --no-dev"
fi

cd /src && \
  curl -vvv -L -k https://getcomposer.org/installer > /src/composer-setup.php && \
  php /src/composer-setup.php && \
  chmod +x /src/composer.phar && \
  /src/composer.phar config -g github-oauth.github.com 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 && \
  /src/composer.phar self-update && \
  /src/composer.phar install $COMPOSER_DEV_PACKAGES_ARG

rm -f /src/composer.phar /src/composer-setup.php

cd ${APP_PATH};
echo " >> Wait $WAIT_DB_HOST:$WAIT_DB_PORT ..."
while ! timeout 1 bash -c "</dev/tcp/$DB_HOST/$DB_PORT"; do
    WAIT_AFTER_CONNECT=30
    sleep 5;
done

echo " >> Create reports dir"
mkdir -p runtime/reports

echo " >> Create queue log dir"
mkdir -p runtime/logs/queue

echo " >> Create codes dir"
mkdir -p runtime/codes

echo " >> Create Epcis dir"
mkdir -p runtime/reports/epcis

echo " >> Create Swagger dir"
mkdir -p runtime/swagger

echo " >> Create Epcis dir"
mkdir -p runtime/reports/analytics

sleep $WAIT_AFTER_CONNECT;

echo ">>> RUN init/check/index"
./yii init/check/index

echo ">>> RUN init/load-dump/index"
./yii init/load-dump/index

echo ">>> RUN init/sql-loader/index"
./yii init/sql-loader/index

echo ">>> RUN init/rbac/load"
./yii init/rbac/load

echo ">>> RUN ./yii l4-queue/enable-disable-triggers"
./yii l4-queue/enable-disable-triggers;

echo " >> Wait dump load ended $WAIT_AFTER_CONNECT"
./yii migrate --interactive=0;

echo ">>> RUN yii init/constants/set-default-values"
./yii init/constants/set-default-values;

echo ">>> RUN init/constants/sync-global-company-prefix"
./yii init/constants/sync-global-company-prefix;

echo ">>> RUN yii generation-rebuild-file/rebuild"
./yii generation-rebuild-file/rebuild;

echo ">>> RUN yii init/update-version/to_1_5_16"
./yii init/update-version/to_1_5_16

echo ">>> RUN cache flush"
rm -rf ./runtime/cache/*;

echo ">>> RUN swagger file flush"
rm -rf ./runtime/swagger/*;

cd $PWD;

# запуск nginx, fpm, cron и supervisor только если это НЕ локальное окружение (не задана переменная IS_LOCAL_ENV)
if [[ -z "${IS_LOCAL_ENV}" ]]; then

  # запуск fpm, cron и supervisor только если это НЕ тестовое окружение (не задана переменная IS_TEST_ENV)
  if [[ -z "${IS_TEST_ENV}" ]]; then
    echo ">>> Start cron background service"
    crontab /etc/cron.d/root
    echo ">>> Test cron"
    crontab -l
    cron

    mkdir -p /etc/supervisor.d/
    if [[ ${SERVER_TYPE} == 4 ]]; then
      cp /src/docker/supervisor/l4/*.conf /etc/supervisor/conf.d/
    else
      cp /src/docker/supervisor/*.conf /etc/supervisor/conf.d/
    fi

    echo ">>> Start supervisor service"
    supervisord -c /etc/supervisor/supervisord.conf
  fi
  echo ">>> Create flag of deploy is done (file .deploy_done)"
  touch /src/.deploy_done
  
  echo ">>> Start main php-fpm service"
  php-fpm -R
  
  #запуск nginx всегда последний - так как он не отпускает терминал после
  echo ">>> Start NGINX"
  nginx -g "daemon off;" -c /etc/nginx/nginx.conf
else
  echo ">>> Create flag of deploy is done (file .deploy_done)"
  touch /src/.deploy_done
fi
