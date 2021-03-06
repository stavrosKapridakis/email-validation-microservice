# Email validation  microservice
## Functionality

This microservice takes as parameters one email or domain and one provider and returns whether 
the corresponding email address is disposable. The microservice provides only one route. 

Parameters
* `email` - the email address to validate (required)
* `provider` - the validation provider to be used (optional)

In case no provider param is posted, the service uses the one which is set as default.
Any extra parameters will be ignored.

The microservice caches the returned value for a given time and returns 
Success-Error response in json format.

# Route

### Request api endpoint
```bash 
Post /api/validate
```
### Request Headers
```bash 
Accept: application/x-www-form-urlencoded
```
        
### Params

Name          | Value                                        | Required/Optional
--------------|--------------------------------------------- |------------------
**email**     | the email address to validate                |required
**provider**  | string, the email validation provider to use |optional
                           
    
### Providers
     Currently the service supports two providers
     * kickbox(default)
     * debounce
     
### Cache
     Currently the service supports two providers
     * Redis
     * Memcached
     In case non of the above Classes are installed the API 
     is still usable. 
  
### Success Response
    Response body:
    {
        "disposable": "false"
    }
    
    Response body:
    {
        "disposable": "true"
    }
    
    
### Error Response
    Response body:
       {
           "message": "error_message"
       }

## Error Codes and Messages
    * 422  The email param is required

        
## Run the app
    Inside projects directory command line run:
    php artisan serve

## Run the tests
From the root of the project run
##### Windows
```
.\vendor\bin\phpunit
```
##### Unix
```
./vendor/bin/phpunit
