document.addEventListener('DOMContentLoaded', () => {
    const selectedSlots = [];
    const allowedSlots = [
        '12:00 - 13:00',
        '13:00 - 14:00',
        '01:00 - 02:00',
        '02:00 - 03:00'
    ];

    const body = document.body;
    const paymentRoute = body.dataset.paymentRoute;
    const courtNumber = body.dataset.courtNumber;
    const bookNowButton = document.getElementById('book-now-btn');

    document.querySelectorAll('.book-btn[data-time]').forEach((button) => {
        button.addEventListener('click', () => {
            const time = button.dataset.time;

            if (!allowedSlots.includes(time)) {
                alert('Invalid timeslot selected.');
                return;
            }

            if (selectedSlots.includes(time)) {
                alert(`You have already selected ${time}`);
                return;
            }

            selectedSlots.push(time);
            button.textContent = 'Selected';
            button.disabled = true;
        });
    });

    bookNowButton.addEventListener('click', () => {
        if (selectedSlots.length === 0) {
            alert('Please select at least one available timeslot.');
            return;
        }

        const params = new URLSearchParams({
            court: courtNumber,
            timeslots: selectedSlots.join(',')
        });

        window.location.href = `${paymentRoute}?${params.toString()}`;
    });
});
