import { fetchJSON } from "./functions/apisystemecommentaire.js";
import {alertElement} from "./functions/alertsystemecommentaire.js";

class InfinitePagination {
  /** @type {string} */
  #endpoint;
  /** @type {HTMLTemplateElement} */
  #template;
  /** @type {HTMLElement} */
  #target;
  /**@type {HTMLElement} */
  #loader
  /** @type {object} */
  #elements;
  /** @type {IntersectionObserver} */
  #observer;
  /**@type {boolean} */
  #loading = false;
  /**@type {number} */
  #page = 1;

  /**
   * @param {HTMLElement} element
   */
  constructor(element) {
	this.#loader=element
    this.#endpoint = element.dataset.endpoint;
    this.#template = document.querySelector(element.dataset.template);
    this.#target = document.querySelector(element.dataset.target);
    this.#elements = JSON.parse(element.dataset.elements);
    this.#observer = new IntersectionObserver((entries) => {
      for (const entry of entries) {
        if (entry.isIntersecting) {
          this.#loadMore();
        }
      }
    });
    this.#observer.observe(element);
  }

  async #loadMore() {
    if (this.#loading) {
      return;
    }
	try{
    this.#loading = true;
    const url = new URL(this.#endpoint);
    url.searchParams.set('_page', this.#page);
    const comments = await fetchJSON(url.toString());
	if(this.#page===3){
		this.#observer.disconnect()
		this.#loadMore.remove()
		return
	}
    for (const comment of comments) {
      const commentElement = this.#template.content.cloneNode(true);
      for (const [key, selector] of Object.entries(this.#elements)) {
        commentElement.querySelector(selector).textContent = comment[key];
      }
      this.#target.append(commentElement);
    }
    this.#page++;
    this.#loading = false;
	}catch(e){
		this.#loader.style.display="none"
		const error=alertElement("Impossible de charger les contenus")
		error.addEventListener('close',() => {
			this.#loader.style.removeProperty('display')
			this.#loading=false
		})
		this.#target.append(error)
	}
  }
}



class FetchForm{
	/** @type {string} */
	#endpointt;
	/** @type {HTMLTemplateElement} */
	#templatee;
	/** @type {HTMLElement} */
	#targett;
	/**@type {HTMLElement} */
	#loaderr
	/** @type {object} */
	#elementss;
	/** @type {IntersectionObserver} */
	#observerr;
	/**@type {boolean} */
	#loadingg = false;
	/**@type {number} */
	#pagee= 1;
  
	/**
 	*	 
 	* @param {HTMLFormElement} form 
 	*/
	constructor(form){
		this.#endpointt = element.dataset.endpointt;
    	this.#templatee = document.querySelector(element.dataset.templatee);
    	this.#targett = document.querySelector(element.dataset.targett);
    	this.#elementss = JSON.parse(element.dataset.elementss);
		form.addEventListener('submit',e =>{
			e.preventDefault()
			this.#submitForm(e.currentTarget)
		})
	}
	/**
	 * 
	 * @param {HTMLFormElement} form 
	 */
	async #submitForm (form){
		const button=form.querySelector('button')
		button.setAttribute('disabled','')
		try {
			const data = new FormData(form)
			const comment = await fetchJSON(this.#endpointt, {
			  method: 'POST',
			  json:Object.fromEntries(data)
			})
            const commentElement = this.#templatee.content.cloneNode(true);
            for (const [key, selector] of Object.entries(this.#elementss)) {
              commentElement.querySelector(selector).textContent = comment[key];
            }
            this.#targett.prepend(commentElement);
            form.reset()
            button.removeAttribute('disabled')
            form.insertAdjacentElement('beforebegin',alertElement('Merci pour votre commentaire','success'))
		}catch(e){
            const errorel=alertElement('ERREUR')
            form.insertAdjacentElement('beforebegin',errorel)
            errorel.addEventListener('close',() =>{
                button.removeAttribute('disabled')
            })
		}
	}

}

  
