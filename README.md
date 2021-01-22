# REST API

An application that sends an email with a generated PDF file. The PDF file is filled with [A-Z0-9]{2} codes. 

## Installation

1️⃣ Clone this repository.

```git
git clone https://github.com/kubaan/php-rest-api.git
```

2️⃣ Go to the application folder

```
cd php-rest-api
```

3️⃣ Use the package manager [composer](https://getcomposer.org/) to build application

```composer
composer install -a
```

4️⃣  Run the PHP local server

```
php -S localhost:8000 index.php
```

5️⃣ Enter the website through the browser
```
localhost:8000
```

6️⃣ Done!

## Endpoint

```http
GET ?count=:count&email=:email
```

#### Parameters

| Name | Required | Type | Description |
| ------ | ------ | ------ | ------ |
| `count` | required | integer | Number of codes to be generated. |
| `email` | required | string | Email address to which the PDF file will be sent. |

#### Response

```
{
    "status": 200,
	"success": true,
    "message": "E-mail has been sent successfully",
    "data": {
        "email_address": "exaple@mail.com", //email address
        "file": {
            "name": "8gPdfQHrachq.pdf",
            "codes_count": "10",
            "codes": [ //generated codes
                "70",
                "RN",
                "YE",
                "J6",
                "6N",
                "9Z",
                "HC",
                "WZ",
                "OH",
                "SG"
            ]
        }
    }
}
```
##### Required parameters are not set

```
{
    "status": 400,
	"success": false,
    "message": "Invalid endpoint address - parameters are not set"
}
```

##### Count parameter is less than 1

```
{
    "status": 400,
	"success": false,
    "message": "Count must be at least 1"
}
```

##### Invalid e-mail parameter

```
{
    "status": 400,
	"success": false,
    "message": "Invalid e-mail address"
}
```