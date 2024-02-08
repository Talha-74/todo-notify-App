$(document).ready(function () {
    var notificationsWrapper = $('.dropdown-notifications');
    var notificationsToggle = notificationsWrapper.find('a[data-toggle]');
    var notificationsCountElem = notificationsToggle.find('i[data-count]');
    var notificationsCount = parseInt(notificationsCountElem.data('count'));
    var notifications = notificationsWrapper.find('ul.dropdown-menu');

    if (notificationsCount <= 0) {
        notificationsWrapper.hide();
    }

    var pusher = new Pusher('API_KEY_HERE', {
        encrypted: true
    });

    var channel = pusher.subscribe('tasks');

    channel.bind('TaskAssigned', function (data) {
        var existingNotifications = notifications.html();
        var avatar = Math.floor(Math.random() * (71 - 20 + 1)) + 20;
        var newNotificationHtml = `
            <li class="notification active">
                <div class="media">
                    <div class="media-left">
                        <div class="media-object">
                            <img src="https://api.adorable.io/avatars/71/${avatar}.png" class="img-circle" alt="50x50" style="width: 50px; height: 50px;">
                        </div>
                    </div>
                    <div class="media-body">
                        <strong class="notification-title">${data.message}</strong>
                        <div class="notification-meta">
                            <small class="timestamp">about a minute ago</small>
                        </div>
                    </div>
                </div>
            </li>
        `;
        notifications.prepend(newNotificationHtml);
    });
});
