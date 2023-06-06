/**
*Crée un element HTML representant
/*@param {{title:string,body:string}}post
 *@return {HTMLElement}
/*console.log ('Info')
console.log('Warning')
console.log('Error')
const person={firstname:'John'}
console.log(person)
person.firstname='Jane'
function createArticle(post){
	const article=document.createElement('article')
	article.innerHTML=`
		<h2>${post.title}</h2>
		<p${post.body}</p>
	`
	return article	
}

async function main(){
	const wrapper=document.querySelector("#lastPosts")
	const loader=createElement("p")
	loader.innerText="chargement..."
	wrapper.append(loader)
	try{
	const r=await fetch("https://jsonplaceholder.typicode.com/posts?_limit=5",{
		headers:{
			Accept:'application/json'
		}
	})
	if(!r.ok)
	{
		throw new Error('Error serveur')
	}
	const posts=await r.json()
	loader.remove()
	for (let post of posts){
		wrapper.append(createArticle(post))
	}
	}catch(e){
		loader.innerText="impossible de charger les articles"
		loader.style.color="red"
		return
	}
}
main()
/**
 * 
 * @param {string} name
 * @return {string|null}
 
function getCookie(name){
	const cookies = document.cookie.split(';')
	const value = cookies
		.find(c => c.startsWith(name))
		?.split('=')[1]
		if(value===undefined)
		{
			return null
		}
		return decodeURIComponent(value)	
}
/**
 * 
 * @param {string} name 
 * @param {string} value 
 * @param {number} days 
 
function setCookie(name,value,days){
	const date = new Date()
	date.setDate(date.getDate() + days)
	document.cookie=`${name}=${encodeURIComponent(value)}; expires=${date.toUTCString()};`
}


fetch('https://jsonplaceholder.typicode.com/todos?_limit=10')*/


const h1=document.querySelector('h1')
console.log(
	'Position par rapport au haut',
	window.scrollY + h1.getBoundingClientRect().y,
	recursiveOffsetTop(h1)
)

document.querySelector('div').addEventListener('mousemove',e => {
	console.log(e.offsetX,e.pageX)
})

function recursiveOffsetTop (element){
	if(element.offsetParent)
	{
		return element.offsetTop + recursiveOffsetTop()
	}
	else
	{
		return element.offsetTop
	}
}

const div=document.querySelector('div')
console.log(div.dataset.user)
div.dataset.hello="bonjour"
console.log(div.dataset)
const button = document.querySelector('button')
const listener=() => {
	console.log(button.dataset.name)
	if(i>=3)
	{
		button.removeEventListener('click',listener)
	}
}
button.addEventListener('click', () => {
	console.log(button.dataset.name)
})

const observer=new IntersectionObserver((entries)=>{
	for(const entry of entries)
	{
		if(entry.isIntersecting)
		{
			entry.target.animate([
				{transform: 'translateX(-50px)',opacity:0},
				{transform: 'translateX(0px)',opacity:1},
			],{
				duration:500
			})
		}
		observer.unobserve(entry.target)
	}
})

observer.observe(document.querySelector(".btn1")) 
observer.observe(document.querySelector(".btn2"))
observer.disconnect()