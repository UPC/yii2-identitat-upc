yii2-identitat-upc
==================

yii2-identitat-upc implementa la validació CAS en el servidor de la UPC.

Requisits
---------

yii2-identitat-upc necessita que el servidor on s'executi tingui accés al servidor CAS de la UPC.

Instal·lació
------------

La manera recomenada d'instal·lar aquesta extensió és mitjançant [composer](http://getcomposer.org/download/).

Cal que afegeixis

```json
"upc/yii2-identitat-upc": "~0.1.0",
```

a la secció `require` del fitxer `composer.json` de la teva aplicació.

També cal que afegeixis

```json
    {
        "url": "https://github.com/upc/yii2-identitat-upc.git",
        "type": "git"
    }
```

a la secció `repositories` del fitxer `composer.json` de la teva aplicació.

Un cop fet això, cal instalar les dependències.

Si estàs treballant a una màquina virtual, executa la següent comanda:

```bash
composer install
```

Si ja havies treballat prèviament amb l'aplicació, executa la següent comanda:

```bash
composer update
```

Això crearà el directori `upc\yii2-identitat-upc` dins del directori `vendor` de la teva aplicació.

Utilització
-----------

Configura el component `user`

```php
'user' => [
    'class' => 'upc\identitat\User',
    'identityClass' => 'app\models\User',
    'casServerVersion' => '2.0'
    'casServerHostname' => 'cas.upc.edu'
    'casServerPort' => 443
    'casServerCA' => '@upc/identitat/ca_bundle.crt'
    'casVerbose' => false;
],
```

a la secció `components` del fitxer de coniguració de l'aplicació. El fitxer de configuració de l'aplicació es troba normalment a `app\config`.

A continuació cal modificar les accions `actionLogin` i `actionLogout` (normalment localitzades a `SiteController`).

```php
public function actionLogin()
{
    Yii::$app->user->login(Yii::$app->user->authenticate());
    return $this->redirect(['site/index']);
}

public function actionLogout()
{
    Yii::$app->user->logout();
    return $this->redirect(['site/index']);
}
```
Finalment ens hem d'assegurar que la classe  introduïda al camp  `identityClass` de `user` implementi l'interfaç `IdentityInterace`.

```php
	/**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['username' => $id]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
   {
       throw new NotSupportedException("findIdentityByAccessToken not implemented");
   }

   /**
    * @inheritdoc
    */
   public function getId()
   {
       return $this->username;
   }

   /**
    * @inheritdoc
    */
   public function getAuthKey()
   {
       throw new NotSupportedException("getAuthKey not implemented");
   }

   /**
    * @inheritdoc
    */
   public function validateAuthKey($authKey)
   {
       throw new NotSupportedException("validateAuthKey not implemented");
   }
```


Llicència
---------

Copyright (C) 2015-2016 Universitat Politècnica de Catalunya - UPC BarcelonaTech - www.upc.edu

```
This program is free software: you can redistribute it and/or modify
it under the terms of the GNU Affero General Public License as
published by the Free Software Foundation, either version 3 of the
License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU Affero General Public License for more details.

You should have received a copy of the GNU Affero General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
```
