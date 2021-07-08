document.addEventListener('DOMContentLoaded', () => {
	paw.loadScript('MainMenu', '/js/components/FetchApi.js', () => {
		const confirmOrder = new ConfirmOrder()
	})
})

class ConfirmOrder {
	constructor() {
		const container = document.querySelector('.content')
		const paymentButton = paw.newElement('button', 'Continuar y pagar', { class: 'main_button' })
		paymentButton.addEventListener('click', _ => {
			FetchApi.get(window.location.origin + '/payment_result', {}, _ => {
                if (r.status >= 200 && r.status < 300) window.location.href = window.location.origin
            })
		})
		container.appendChild(paymentButton)
	}
}
