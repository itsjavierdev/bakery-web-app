document.addEventListener("DOMContentLoaded", function () {
    document
        .querySelectorAll(".module-checkbox")
        .forEach(function (moduleCheckbox) {
            moduleCheckbox.addEventListener("change", function () {
                let module = this.getAttribute("data-module");
                let checkboxes = document.querySelectorAll(
                    `.permission-checkbox[data-module="${module}"]`
                );
                checkboxes.forEach(function (checkbox) {
                    checkbox.checked = moduleCheckbox.checked;
                    // Trigger change event for Livewire to pick up the change
                    checkbox.dispatchEvent(new Event("change"));
                });
            });
        });
});
