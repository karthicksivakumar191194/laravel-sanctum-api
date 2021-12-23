# Laravel - Sanctum

- Run **php artisan: serve** cmd on the terminal
- Open the application in the  browser http://localhost:8000

## Testing API on Postman
 - When testing API on postman - use **Accept - application/json** in headers.
 
## Notes
###### Authenticating via cookie based session  - Authentication from same domain or sub domain
  * When u authenticate SPA which not hosted on same domain of API,  hit `/sanctum/csrf-cookie'` API, after that you dont have to hit it again and again for every request, Because this `/sanctum/csrf-cookie` API will save the `XSRF token` on browser and Axios will send it with the request.
  * The `XSRF-TOKEN` cookie comes with a time of expiry. After that time, the browser deletes it. So as long as you can find the cookie, it is safe to make a request without calling `/sanctum/csrf-cookie`
  
###### Authenticating via Token - Authentication from different domain or mobile Application