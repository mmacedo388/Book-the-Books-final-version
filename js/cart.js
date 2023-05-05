const cartModal = document.getElementById('cartModal') // HTMLElement (object)
const quantityInputs = cartModal.querySelectorAll('input[name="quantity"]') // HTMLElement (object)

const formatCurrency = (value) => {
	return new Intl.NumberFormat('pt-PT', { style: 'currency', currency: 'EUR' }).format(value)
}

// actualizar na modal
const refreshQuantity = (input, quantity) => {
	const price = parseFloat(input.dataset.price)
	// console.log(quantity, price)
	
	const row = input.closest('tr')

	// const subTotalEl = input.parentElement.nextElementSibling
	const subTotalEl = row.querySelector('td.sub-total')
	const newSubTotal = quantity * price

	subTotalEl.innerHTML = formatCurrency(newSubTotal)

	const subTotal = parseFloat(row.dataset.subTotal)
	const cartTotalEl = cartModal.querySelector('.cart-total')
	const newTotal = parseFloat(cartModal.dataset.total) - subTotal + newSubTotal

	cartTotalEl.innerHTML = formatCurrency(newTotal)
	cartModal.dataset.total = newTotal
	row.dataset.subTotal = newSubTotal
}

quantityInputs.forEach(function(input) {
	input.addEventListener('input', (event) => {
		const input = event.target
		const quantity = parseInt(input.value)

		if (isNaN(quantity)) {
			return;
		}

		const data = new FormData
		data.set('quantity', quantity)
		data.set('id',  input.dataset.productId)

		// actualizar na sessao
		fetch('/cart/update-quantity.php', {
			method: 'POST',
			body: data
		})
		.then((response) => {
			if (response.status === 204) {
				refreshQuantity(input, quantity)
			}
		})
	
		// console.log('this code comes after fetch')
	})
})