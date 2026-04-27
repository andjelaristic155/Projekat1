function moveSelectedToTop() {
  let select = document.getElementByClass("mySelect");
  let selectedOption = select.options[select.selectedIndex];
  
  // Kreiraj novu opciju sa istim vrednostima
  let newOption = new Option(selectedOption.text, selectedOption.value, true, true);
  
  // Ukloni staru opciju
  select.remove(select.selectedIndex);
  
  // Dodaj novu opciju na početak liste
  select.add(newOption, select.options[0])}

  function changeCount(id, change) {
  const countEl = document.getElementById(id);
  let count = parseInt(countEl.textContent);
  count += change;
  if (count < 0) count = 0;
  countEl.textContent = count;
}


