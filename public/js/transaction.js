let currentCategoryByTransaction = {
    default: 'select',
}

let toggleCategoryAdd = (transactionId = '') => {
    let categorySelect = $(`#category-select${transactionId}`);
    let categoryCreate = $(`#category-create${transactionId}`);
    let categorySelectToggleBtn = $(`#category-select-toggle${transactionId}`);

    let currentCategoryMode = currentCategoryByTransaction[transactionId || 'default'];
    currentCategoryMode = currentCategoryMode === 'create' ? 'select' : 'create';
    currentCategoryByTransaction[transactionId || 'default'] = currentCategoryMode;

    let visible = currentCategoryMode === 'select' ? categorySelect : categoryCreate;
    let hidden = currentCategoryMode === 'select' ? categoryCreate : categorySelect;

    visible.removeAttr('hidden');
    hidden.attr('hidden', true);

    visible.attr('name', 'category');
    hidden.removeAttr('name');

    categorySelectToggleBtn.html(currentCategoryMode === 'select' ? '<i class="fa-solid fa-plus"></i> Add New' : '<i class="fa-solid fa-arrow-left"></i>');
}

let resetCategoryType = (transactionId = 'default') => {
    if (currentCategoryByTransaction[transactionId] !== 'select') {
        toggleCategoryAdd(transactionId);
    }
    currentCategoryByTransaction[transactionId] = 'select';
}
