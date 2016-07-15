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
"upc/yii2-identitat-upc": "~1.0",
```

a la secció `require` del fitxer `composer.json` de la teva aplicació.

També cal que afegeixis

```json
    {
        "url": "https://github.com/oteixido/yii2-identitat-upc.git",
        "type": "git"
    }
```

a la secció `repositories` del fitxer `composer.json` de la teva aplicació.

Utilització
-----------

Configura el component `user`

```php
'user' => [
    'class' => 'upc\identitat\User',
    'identityClass' => 'app\models\User',
],
```

a la secció `components` del fitxer de coniguració de l'aplicació.

Tamé cal modificar les accions `login` i `logout`.

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
