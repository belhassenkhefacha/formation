/**
 * Renvoie un element HTML representant une alerte
 * @param {string} message 
 * @return {HTMLElement}
 */

export function alertElement(message,type="danger"){
    /** @type {HTMLElement} */
    const l=document.querySelector('#alert').content.firstElementChild.cloneNode(true)
    l.classList.add(`{alert-${type}`)
    l.querySelector('.js-text').innerText = message
    l.querySelector('button').addEventListener('click',e =>{
        l.preventDefault()
        console.log(l)
        l.remove()
        l.dispatchEvent(new CustomEvent('close'))
    })
    return l
}
