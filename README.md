yii2-identitat-upc
==================

yii2-identitat-upc implementa la validació CAS contra el servidor de la UPC.

Requisits
---------

yii2-identitat-upc necessita que el servidor on s'executi tingui accés al servidor CAS de la UPC.

Instal·lació
------------

La manera recomenada d'instal·lar aquesta extensió és mitjançant [composer](http://getcomposer.org/download/).

Cal que afegeixis

```json
"require": {
    ...
    "upc/yii2-identitat-upc": "~1.0",
    ...
},

```

a la secció `require` de la teva aplicació `composer.json` file.

També cal que afegeixis el repositori `https://github.com/upc`

```json
"repositories": [
    {
        "url": "https://github.com/oteixido/yii2-identitat-upc.git",
        "type": "git"
    }
],
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
