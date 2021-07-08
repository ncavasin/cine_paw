document.addEventListener('DOMContentLoaded', () => {
    paw.loadScript('MainMenu', '/js/components/FetchApi.js', () => {
        const selSeat = new SelSeat()
    })
})

class SelSeat {
    loading = true
    ticketsCount = 0
    occuped = []
    selected = []

    constructor() {
        const mainElm = document.querySelector('main')
        const loader = paw.newElement('div', '', {class: 'loader-container'})
        loader.appendChild(paw.newElement('div', '', {class: 'loader'}))
        mainElm.appendChild(loader)
        this.subscribeSeatClick()
        FetchApi.get(window.location.origin+'/room_info', {}, r => {
            this.locateOccuped(r.occuped)
            this.locateTickets(r.ticketsCount)
            mainElm.removeChild(loader) // no se ve, revisar estilo
        })
    }

    onSeatClick = seat => {
        if (!seat.classList.contains('occuped')){
            var deletedSeat = this.selected.shift()
            deletedSeat = document.querySelector(`#${deletedSeat}`)
            deletedSeat.classList.remove('selected')
            this.selected.push(seat.id)
            seat.classList.add('selected')
        }
    }

    subscribeSeatClick = () => {
        document.querySelectorAll('.butaca').forEach(e => {
            e.addEventListener('click', e => this.onSeatClick(e.target))
        })
    }

    locateOccuped = occuped => {
        this.occuped = occuped
        occuped.forEach(seatId => {
            const seat = document.querySelector(`#${seatId}`)
            seat.classList.add('occuped')
        })
    }

    locateTickets = ticketsCount => {
        this.ticketsCount = ticketsCount
        let assigned = 0
        const seatList = document.querySelectorAll('.butaca')
        /* seatList = seatList.sort((a,b) => {
            if (a.id > b.id) return 1
            else return -1
        }) */
        console.log(seatList)
        for (var i = 0; i < seatList.length && assigned < ticketsCount; i++) {
            if (this.occuped.indexOf(seatList[i].id) === -1) { // Si este asiento no esta en la lista de ocupados entonces.. 
                assigned++
                seatList[i].classList.add('selected')
                this.selected.push(seatList[i].id)
            }
        }
    }
}