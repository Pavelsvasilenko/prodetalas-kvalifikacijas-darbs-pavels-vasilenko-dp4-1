const value = document.querySelector("#rezultats")
const input = document.querySelector("#range-no")
value.textContent = input.value
input.addEventListener("input", (event) => {
  value.textContent = event.target.value
})