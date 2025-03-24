document.addEventListener('DOMContentLoaded', function () {
    fetchAverageRating();
    fetchFeedbacks();
});

function fetchAverageRating() {
    fetch('/api/average-rating')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            document.getElementById('average-rating').textContent = `Average Rating: ${data.average_rating}`;
        })
        .catch(error => console.error('Error fetching average rating:', error));
}

function fetchFeedbacks() {
    const params = new URLSearchParams({
        sort_by: 'created_at',
        sort_order: 'desc',
        start_date: '2025-01-01',
        end_date: '2025-12-31'
    });

    fetch(`/api/feedback?${params.toString()}`)
        .then(response => response.json())
        .then(data => {
            renderFeedbackList(data);
        })
        .catch(error => console.error('Error fetching feedback:', error));
}

function renderFeedbackList(feedbacks) {
    const feedbackList = document.getElementById('feedback-list');
    feedbackList.innerHTML = '';
    feedbacks.forEach(feedback => {
        const li = document.createElement('li');
        li.innerHTML = `
            <p><strong>Name:</strong> ${feedback.user_name}</p>
            <p><strong>Email:</strong> ${feedback.user_email}</p>
            <p><strong>Feedback:</strong> ${feedback.feedback_comment}</p>
            <p><strong>Rating:</strong> ${feedback.rating}</p>
            <p><strong>Date:</strong> ${new Date(feedback.created_at).toLocaleDateString()}</p>
            <hr>
        `;
        feedbackList.appendChild(li);
    });
}