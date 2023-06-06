
/**
*
*@param {PointerEvent} event
*/
function onButtonClick(event){
	event.preventDefault()
	event.stopPropagation()
	console.log(event)
}

const button = document.querySelectorAll('button ,a').forEach(button)
button.addEventListener('click',onButtonClick,{
	once:true})

document.querySelector('div').addEventListener('click', () => {
	console.kig('click div')
})

document.querySelector('form').addEventListener('submit',(e) => {
	console.log(e)
	e.preventDefault()
	const form= e.currentTarget
	const data=new FormData(form)
	console.log(data.get('firstname'))
	if(firstname.length<2)
	{
		e.preventDefault()
	}
})


document.querySelector('input').addEventListener('change',(e) => {
	console.log('change')
})

document.querySelector('input').addEventListener('input',(e) => {
	console.log('change',e.currentTarget.value)
})

document.querySelector('input').addEventListener('keydown',(e) => {
	if(e.ctrlKey ===true && e.key === 'k')
	{
		e.preventDefault()
		console.log('racourci',e)
	}
})

document.querySelector('input').addEventListener('change',(e) => {
	console.log(e.currentTarget.checked)
})

document.querySelector('select').addEventListener('change',(e) => {
	console.log(e.currentTarget.value)
})

const spoilers=document.querySelectorAll('.spoiler')
function revealSpoiler(){
	spoilers.forEach(spoiler => spoiler.classList.remove('.spoiler'));
}

spoilers.forEach(spoiler => {
	spoiler.addEventListener('click',revealSpoiler)
	
})



