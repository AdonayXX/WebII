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

function toggleShowMoreLess(sectionClass, showMoreBtnId, showLessBtnId) {
    const showMoreBtn = document.getElementById(showMoreBtnId);
    const showLessBtn = document.getElementById(showLessBtnId);
    const properties = document.querySelectorAll(`.${sectionClass}`);

    if (showMoreBtn && showLessBtn) {
        showMoreBtn.addEventListener('click', function () {
            properties.forEach(function (property) {
                property.style.display = 'block';
            });
            showMoreBtn.style.display = 'none';
            showLessBtn.style.display = 'inline-block';
        });

        showLessBtn.addEventListener('click', function () {
            properties.forEach(function (property) {
                property.style.display = 'none';
            });
            showLessBtn.style.display = 'none';
            showMoreBtn.style.display = 'inline-block';
        });
    }
}

toggleShowMoreLess('more-properties-featured', 'showMoreBtn-featured', 'showLessBtn-featured');
toggleShowMoreLess('more-properties-alquiler', 'showMoreBtn-alquiler', 'showLessBtn-alquiler');
toggleShowMoreLess('more-properties-ventas', 'showMoreBtn-ventas', 'showLessBtn-ventas');
