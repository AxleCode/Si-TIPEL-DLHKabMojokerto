function fetchNotifications() {
    axios.get('/notifications')
        .then(response => {
            const notifications = response.data;
            let notificationHTML = '';

            notifications.forEach(notification => {
                const itemHTML = `
                    <a href="${notification.link}" class="list-group-item">
                        <div class="row g-0 align-items-center">
                            <div class="col-2">
                                <i class="${notification.textlogo} ms-2" data-feather="${notification.logo}"></i>
                            </div>
                            <div class="col-10">
                                ${notification.status ? '<div class="text-white">' : '<div class="text-dark">'}
                                    ${notification.judul}
                                </div>
                                <div class="text-muted small mt-1">${notification.pesan}</div>
                                <div class="text-muted small mt-1">${notification.created_at}</div>
                            </div>
                        </div>
                    </a>
                `;
                notificationHTML += itemHTML;
            });

            $('#notification-list').html(notificationHTML);
            feather.replace();
        })
        .catch(error => {
            console.error(error);
        });
}

$(document).ready(() => {
    fetchNotifications();
    setInterval(() => {
        fetchNotifications();
    }, 3000);
});