# Mamikos Webservice

MamiKos is a web app where users can search kost that have been added by the owner. Also, users can ask about room availability using the credit system.

# Requirements
- PHP >= 7.3
- BCMath PHP Extension
- Ctype PHP Extension
- Fileinfo PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- Webserver
- MySQL

# Installation

 - Clone this project to your local computer
 - Use `composer install` inside cloned project to install the vendor
 - Copy paste `.env.example` to `.env`, dont forget to setup `.env` according to your environment like database connection, app_debug, app_url and app.env
 - Finally, you can run it using `php artisan serve` and it will show up with default url (http://localhost:8000)

# API Documentation
All of the API except Register & Login, need to bearer a token that created by system.
In this repository also contain [Postman Collection](./mamikos.postman_collection.json) to give you an easier way to test this API 
 
## HTTP Status Code
 - 200 = OK
 - 201 = Created
 - 500 = Failed
 - 404 = Data not found/empty
 - 403 = Forbidden
 - 422 = Unprocessable Entity

## AUTHENTICATION
### Register
URL: http://localhost:8000/api/v1/register
Method: POST
Body:
| Field Name | Type  | Required | Description |
|--|--|--|--|
| name | string | Yes | - |
| email | email | Yes | - |
| password | string | Yes | string, min:6 |
| address | string | Yes | - |
| city | string | Yes | - |
| role | string | Yes | PREMIUM, REGULER OR OWNER |

### Login
URL: http://localhost:8000/api/v1/login
Method: POST
Body:
| Field Name | Type  | Required | Description |
|--|--|--|--|
| email | email | Yes | - |
| password | string | Yes | - |

## KOST (OWNER)
All of KOST API is created by Owner User ROLE, the other's role cannot using KOST API.
### Create a KOST
URL: http://localhost:8000/api/v1/kost
Method: POST
Body:
| Field Name | Type  | Required | Description |
|--|--|--|--|
| name | string | Yes | - |
| address | string | Yes | - |
| city | string | Yes | - |
| detail | text | No | - |
| price | integer | Yes | - |
| room_amount | integer | Yes | - |
| availibility | enum | AVAILABLE, NOT-AVAILABLE | - |

### Update Kost
URL: http://localhost:8000/api/v1/account/update/{id}
Method: PUT
Body:
| Field Name | Type  | Required | Description |
|--|--|--|--|
| name | string | Yes | - |
| address | string | No | - |
| city | string | No | - |
| detail | text | No | - |
| price | integer | No | - |
| room_amount | No | Yes | - |
| availibility | No | AVAILABLE, NOT-AVAILABLE | - |

### GET ALL Kost (For Owner)
URL: https://localhost:8000/api/v1/kost
Method: GET

### GET Detail Kost (For Owner)
URL: https://localhost:8000/api/v1/kost/{id}
Method: GET
Parameter:
| Field Name | Type  | Required | Description |
|--|--|--|--|
| id | integer | Yes | - |

### Delete KOST 
URL: https://localhost:8000/api/v1/kost/{id}
Method: DELETE
Parameter:
| Field Name | Type  | Required | Description |
|--|--|--|--|
| id | integer | Yes | - |

## KOST (USER)
### GET ALL Kost (For User)
URL: https://localhost:8000/api/v1/kost-all
Method: GET

### GET Detail Kost (For User)
URL: https://localhost:8000/api/v1/kost-detail/{id}
Method: GET
Parameter:
| Field Name | Type  | Required | Description |
|--|--|--|--|
| id | integer | Yes | - |


## SEARCH
URL: https://localhost:8000/api/v1/search
Method: POST
Parameter:
| Field Name | Type  | Required | Description |
|--|--|--|--|
| fields | string | Yes | only can be filled by name, location, price (comma delimiter) |
Body:
| Field Name | Type  | Required | Description |
|--|--|--|--|
| keyword | string | No |- |

## Ask Availibity
### (ASK Feature for USER)
URL: https://localhost:8000/api/v1/chat
Method: POST
Body:
| Field Name | Type  | Required | Description |
|--|--|--|--|
| kost_id | integer | Yes |- |
| message | string | Yes |- |

### (Reply Feature for Owner)
URL: https://localhost:8000/api/v1/chat/{id}
Method: POST
Parameter:
| Field Name | Type  | Required | Description |
|--|--|--|--|
| id | integer | Yes | chat_id |
Body:
| Field Name | Type  | Required | Description |
|--|--|--|--|
| replies | string | Yes |- |


## Credits
 
Fullstack Developer - Imanuel Ronaldo (@nathanael79)
 
## License
 
The MIT License (MIT)

Copyright (c) 2020 Imanuel Ronaldo

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
