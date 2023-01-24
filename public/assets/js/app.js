// // alert('Teste');
// import users from './users';

// users();
import Alpine from 'alpinejs';
import users from './alpine-components/users';

 
window.Alpine = Alpine
window.users = users;

Alpine.start()