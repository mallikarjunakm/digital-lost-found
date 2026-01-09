// ================= LOST ITEMS AJAX =================
function fetchLostItems() {
    const itemType = document.getElementById('lost_item_type').value;
    const date     = document.getElementById('lost_date').value;
    const status   = document.getElementById('lost_status').value;

    fetch('../ajax/fetch-lost-items.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body:
            'item_type=' + encodeURIComponent(itemType) +
            '&date=' + encodeURIComponent(date) +
            '&status=' + encodeURIComponent(status)
    })
    .then(res => res.text())
    .then(html => {
        document.getElementById('lost-items-table').innerHTML = html;
    });
}

// ================= FOUND ITEMS AJAX =================
function fetchFoundItems() {
    const itemType = document.getElementById('found_item_type').value;
    const date     = document.getElementById('found_date').value;
    const status   = document.getElementById('found_status').value;

    fetch('../ajax/fetch-found-items.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body:
            'item_type=' + encodeURIComponent(itemType) +
            '&date=' + encodeURIComponent(date) +
            '&status=' + encodeURIComponent(status)
    })
    .then(res => res.text())
    .then(html => {
        document.getElementById('found-items-table').innerHTML = html;
    });
}
