window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 * Include the Popper.js library, since Boostrap 4 requires it
 */




try {

  window.$ = window.jQuery = require('jquery');

  window.Popper = require('popper.js');
  
  require('bootstrap');
} catch (e) {}

/**
 * Vue is a modern JavaScript library for building interactive web interfaces
 * using reactive data binding and reusable components. Vue's API is clean
 * and simple, leaving you to focus on building your next great project.
 */

window.Vue = require('vue');

Vue.prototype.authorize = function(handler) {
	return handler(window.App.user);
};


Vue.prototype.admin = function(){
   let user = window.App.user;
   let signedIn = window.App.signedIn;
   if(signedIn){
   	return user.role == 'admin' ? true : false;	
   	  
   }else{
   		return false;	
   }
}
/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest'
};