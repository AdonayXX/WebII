const editModal = document.getElementById('editModal');
editModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const propertyId = button.getAttribute('data-id');
    const title = button.getAttribute('data-title');
    const description = button.getAttribute('data-description');
    const price = button.getAttribute('data-price');
    const type = button.getAttribute('data-type');
    const isFeatured = button.getAttribute('data-is_featured') === '1';
    const image = button.getAttribute('data-image');

    document.getElementById('modalPropertyId').value = propertyId;
    document.getElementById('modalTitle').value = title;
    document.getElementById('modalDescription').value = description;
    document.getElementById('modalPrice').value = price;
    document.getElementById('modalType').value = type;
    document.getElementById('modalIsFeatured').checked = isFeatured;
    document.getElementById('currentImage').src = '../img/' + image;
});
