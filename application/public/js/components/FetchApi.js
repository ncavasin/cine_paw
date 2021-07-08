class FetchApi {
	static get = (target, params = {}, callBack) => {
		var url = new URL(target)
		url.search = new URLSearchParams(params).toString()
		fetch(url)
			.then(r => {
				console.log('response', r)
				if (r.status >= 200 && r.status < 300) return r.json()
				else {
					console.error('Error en fetch data ' + url, params)
					return {}
				}
			})
			.then(data => {
				if (callBack) callBack(data)
			})
			.catch(e => console.error(e))
	};

	static post = (target, body, callBack) => {
		fetch(target, {
			method: 'POST',
			headers: { 'content-type': 'application/json' },
			body
		})
			.then(r => {
				console.log('response', r)
				if (r.status >= 200 && r.status < 300) return r.json()
				else {
					console.error('Error en fetch data ' + url, params)
					return {}
				}
			})
			.then(data => {
				if (callBack) callBack(data)
			})
			.catch(e => console.error(e))
	}
}
