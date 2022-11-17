const open = document.getElementById('open')
const close = document.getElementById('close')
const container2 = document.querySelector('.container2')

open.addEventListener('click', () => container2.classList.add('show-nav'))

close.addEventListener('click', () => container2.classList.remove('show-nav'))

const search = document.querySelector('.search')
const btn = document.querySelector('.btn')
const input = document.querySelector('.input')

btn.addEventListener('click', () => {
    search.classList.toggle('active')
    input.focus()
})