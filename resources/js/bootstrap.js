import Echo from 'laravel-echo'

window.Echo = new Echo({
  broadcaster: 'pusher',
  key: 'bdfe315428deccc97169',
  cluster: 'ap2',
  forceTLS: true
});

var channel = Echo.channel('tasks');
channel.listen('.TaskAssigned', function(data) {
  alert(JSON.stringify(data));
        console.log(data);
        // Handle the received event
        appendNotification(data.message);
    });

function appendNotification(message) {
    $('#notificationList').prepend(`<a class="dropdown-item" href="#">${message}</a>`);
}

