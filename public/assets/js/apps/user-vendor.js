document.querySelector("#inputKeyword").addEventListener("keyup", CORE.delay(function() {
  const keyword = document.querySelector("#inputKeyword").value;
  Livewire.emit("set_keyword", keyword);
}, 1000));

function filterVendor() {
  const inputs = document.querySelectorAll(".input-filter-vendor");
  let filters = {};

  inputs.forEach(input => {
    filters[`${input.name}`] = input.value;
  });

  CORE.closeModal("modalFIlter");
  Livewire.emit("set_filter", filters);
}
