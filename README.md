# how to install this project...
- Simply do git clone of this project...
- Ideally everything should sit in the web server directory that has the ability to run php applications.

# what is requried to run the project
   ## Front end application
   - you can simply access it via the index.html file in your browser (however best to have evrything else setup before accesing it)
   
   ## express backend
   - Node version v16.13.1
   - NPM  version 6.14.16

   ## php backend middleware
   - composer
   - php >=7.4


# install the packages for each directory
## php middleware 
   - cd into the project directory.
   - do a composer install
## express backend
   - cd into project directory
   - do a npm instal

# how to run this project
## php middleware 
   - should be running on localhost and can be accessed via browser `http://localhost/pocker-hand-evaluator-code-assessment/public`
## express backend
   - cd into project director
   - run command `node index.js` in terminal should see listing for connection
   - `http://localhost:3000`
   - will be accessed from front or you attempt to access via endpoint.

## front end 
   - can just be accessed via `http://localhost/pocker-hand-evaluator-code-assessment/front-end`

# what is missing: 
- the only thing that is missing is having unit tests for the php and express js portion
- and more styling done to the fron end portion