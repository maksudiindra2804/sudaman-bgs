Introduction
---------
Yii-Encrypter is a simple encryption module, using mcrypt.

###Requirements

* Yii 1.0 or above
* PHP 5
* mcrypt module for PHP

###Installation

* Extract the release file under `protected/extensions/encrypter`
* Add a line to your configuration file to import the extension:
```
'import'=>array(
    'application.extensions.encrypter.Encrypter',
),
```
* Add to your main.php file within your Yii project, inside the component array,
  and change the value of 'key' to something secure and sensible.
```
'components'=>array(
    'encrypter'=>array (
        'class'=>'Encrypter',
        'key'=>'XXXXXXXXXXXXXXXX',
    ),
),
```
* Recommend also utilizing a separate configuration file for main.php, one that
  is not located within your code repository.

###Usage

Access the encrypt object:
```
Yii::app()->encrypter
```

To encrypt:
```
$myEncryptedString = Yii::app()->encrypter->encrypt($myDecryptedString);
```

To decrypt:
```
$myDecryptedString = Yii::app()->encrypter->decrypt($myDecryptedString);
```

License
---------
Modified BSD License
[https://github.com/gtcode/Yii-Encryper](https://github.com/gtcode/Yii-Encryter)
