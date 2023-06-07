let modal=null
const focusableSelector="button,a,input,textarea"
let focusables= []
let previouslyFocusedElement = null
const openModal=async function(e){
    e.preventDefault()
    const target= e.target.getAttribute('href')
    if(target.startsWith('#'))
    {
        modal = document.querySelector(target)
    }else{
        modal=await loadModal(target)
    }
    
    focusables=Array.from(modal.querySelectorAll(focusableSelector))
    previouslyFocusedElement= document.querySelector(':focus')
    modal.style.display = null
    focusables[0].focus()
    modal.removeAttribute('aria-hidden')
    modal.setAttribute('aria-modal','true')
    modal.addEventListener('click',closeModal)
    modal.querySelector('.js-modal-close').addEventListener('click',closeModal)
    modal.querySelector('.js-modal-stop').addEventListener('click',stopPropagation)
}

const closeModal=function(e){
    if(modal===null)
        return
    if(previouslyFocusedElement!==null)
        previouslyFocusedElement.focus()
    e.preventDefault()
    /*Animation direction reversed
    modal.style.display="none"
    modal.offsetWidth 
    modal.style.display=null
    */
    const hideModal=function(){
        modal.display.style="none"
        modal.removeEventListener('animationend',hideModal)
        modal=null
   }
    modal.addEventListener('animationend',hideModal)
    window.setTimeout(function(){
        modal.style.display="none"
        modal=null
    },500)
    modal.style.display="none"
    modal.setAttribute('aria-hidden','true')
    modal.removeAttribute('aria-modal')
    modal.removeEventListener('click',closeModal)
    modal.querySelector('.js-modal-close').removeEventListener('click', closeModal)
    modal.querySelector('.js-modal-stop').removeEventListener('click', stopPropagation)
    modal=null
}

const stopPropagation = function(e){
    e.stopPropagation
}

const focusModal=function(e){
    e.preventDefault()
    let index = focusables.findIndex(f => f === modal.querySelector(':focus'))
    if(e.shiftKey===true){
        index--
    }else{
    index++
    }
    if(index>=focusables.length){
        index=0
    }
    if(index <0){
        index=focusables.length-1
    }
    focusables[index].focus()
}

const loadModal=async function(url){
    // TODO : Afficher un loader
    const target='#'+url.split('#')[1]
    const exitingModal=document.querySelector(target)
    if(exitingModal===null)
        return exitingModal
    const html=await fetch(url).then(response => response.text())
    const element=document.createRange().createContextualFragment(html).querySelector(target)
    if(element===null)
        throw `L'element ${target} n'a pas été trouvé dans la page ${url}`
    document.body.append(element)
    return element
}

document.querySelectorAll('.js-modal').forEach(a => {
    a.addEventListener('click',openModal)
    
})

window.addEventListener('keydown',function(e){
    if(e.key==="Escape" || e.key==="Esc"){
        closeModal(e)
    }
    if(e.key=="Tab" && modal!=null){
        focusModal(e)
    }
})


