# Tuto Consume API with Symfony 5

*Tuto inspired from YT YoandevCo [here](https://youtu.be/7LxlFzLx-9A)*.

Link to the App host on Heroku: [https://covid-france-chart.herokuapp.com/](https://covid-france-chart.herokuapp.com/ "Covid France Chart")

Use Symfony HTTP Request to display France COVID statistics and charts with ChartJS.

```shell
symfony new covid --full
cd covid
composer require symfony/webpack-encore-bundle
composer require symfony/ux-chartjs
npm install --force
npm run build
sc m:con Home
sc m:con Department
```

## Hébergment sur Heroku

Requires for webpack-encore in `package.json`:

```json
"scripts":
  "heroku-postbuild": "node_modules/.bin/encore production"
```

Host on Heroku:

```shell
cd covid
echo 'web: heroku-php-apache2 public/' > Procfile
composer require symfony/apache-pack
cd ..

heroku create covid-france-chart
heroku config:set APP_ENV=prod
# Add Buildpack to Heroku to compile JS files (associated to Webpack Encore)
heroku buildpacks:set heroku/php
heroku buildpacks:add --index 2 heroku/nodejs
git subtree push --prefix covid heroku main
```