// require('./bootstrap');

var Turbolinks = require("turbolinks")
// Turbolinks.start()
document.addEventListener("livewire:load", function(event) {
  Turbolinks.start();
});
