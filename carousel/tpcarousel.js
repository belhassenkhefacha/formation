class Carousel{
    /**
     * This callback type is called `requestCallback` and is displayed as a global symbol
     * 
     * @callback requestCallback
     * @param {number} index
     */
  
  
    /**
    * 
    * @param {HTMLElement} element 
    * @param {object} options 
    * @param {object} [options.slideToScroll=1] 
    * @param {object} [options.slideToVisible=1]
    * @param {boolean} [options.loop=false]
    * @param {boolean} [options.pagination=false]
    * @param {boolean} [options.navigation=true]
    */
    constructor(element,options={}){
        this.element=element
        this.options=Object.assign({},{
            slideToScroll:1,
            slideToVisible:1,
            loop:false,
            pagination:false
        },options)
        let children=[].slice.call(element.children)
        this.isMobile=false
        this.currentItem=0
        this. root=this.createDivWithClass('carousel')
        this.container=this.createDivWithClass('carousel__container')
        this.root.setAttribute('tabindex','0')
        this.root.appendChild(this.container)
        this.element.appendChild(this.root)
        this.moveCallbacks=[]
        this.items= children.map((child)=>{
            let item=this.createDivWithClass('carousel__item')
            item.appendChild(child)
            this.container.appendChild(item) 
            return  item
        })
        this.setstyle()
        if(this.options.navigation){
            this.createNavigation()
        }
        if(this.options.pagination){
        this.createPagination()
        }
        //evenements
        this.resize()
        window.addEventListener('resize',this.resize.bind(this))
        this.root.addEventListener('keyup',(e)=>{
            if(e.key==='AroowRight' || e.key==='Right'){
                this.next()
            }else if(e.key==='AroowLeft' || e.key==='Left'){
                this.prev()
            }
        })
    };

    /**
     * Applique les bonnes dimensions aux elements du carousel
     */
    setstyle(){
        let ratio=this.items.length/this.slidesVisible
        this.container.style.with=(ratio*100)+"%"
        this.items.forEach(item=> item.style.width=((100/this.slidesVisible)/ratio)+"%")
    }

    createNavigation(){
        let nextButton=this.createDivWithClass('carousel__next')
        let prevButton=this.createDivWithClass('carousel__prev')
        this.root.appendChild(nextButton)
        this.root.appendChild(prevButton)
        nextButton.addEventListener('click',this.next.bind(this))
        prevButton.addEventListener('click',this.prev.bind(this))
        if(this.options.loop===true)
            return
        this.onMove(index=>{
            if(index===0){
                prevButton.classList.add('carousel__prev--hidden')
            }else{
                prevButton.classList.remove('carousel__prev--hidden')
            }
            if(this.items[this.currentItem +this.slidesVisible]===undefined ){
                nextButton.classList.add('carousel__next--hidden')
            }else{
                nextButton.classList.remove('carousel__next--hidden')
            }
        })
    }

    createPagination(){
        let pagination=this.createDivWithClass('carousel__pagination')
        let buttons=[]
        this.root.appendChild(pagination)
        for(let i=0;i<this.items.length;i=i+this.options.slideToScroll){
            let button=this.createDivWithClass('carousel__pagination__button')
            button.addEventListener('click',()=>this.gotoItem(i))
            pagination.appendChild(button)
            buttons.push(button)
            this.onMove(index =>{
                let activebutton=buttons[Math.fllor(index /  this.options.slideToScroll)]
                if(activebutton){
                    buttons.forEach(button => button.classList.remove('carousel__pagination__button--active'))
                    activebutton.classList.add('carousel__pagination__button--active')
                }
            })
        }
    }
    
    next(){
        this.gotoItem(this.currentItem+this.options.slideToScroll)
    }

    prev(){
        this.gotoItem(this.currentItem-this.options.slideToScroll)
    }
    /**
     * Deplace le carousel vers l'element siblé
     * @param {number} index 
     */
    gotoItem(index){
        if(index<0){
            if(this.options.loop)
                index=this.items-length - this.options.slideToVisible
            else
                return
        }else if(index>=this.items.length || this.items[this.currentItem]+this.options.slidesVisible===undefined && index>this.currentItem){
            if(this.options.loop){
                index=0
            }else{
                return
            }
        }
        let translateX=-100 / this.items.length
        this.container.style.transform='translate3d('+translateX+'%,0,0)'
        this.currentItem=index
        this.moveCallbacks.forEach(cb =>cb(0))
    }
    /**
     * 
     * @param {moveCallback} cb 
     */
    onMove(cb){
        this.moveCallbacks.push(cb)
        
    }
    /**
     * 
     * @param {string} className 
     * @returns {HTMLElement}
     */

    resize(){
        let mobile=window.innerWidth<800
        if(mobile!==this.isMobile){
            this.isMobile=mobile
            this.setstyle()
            this.moveCallbacks.forEach(cb=>cb(this.currentItem))
        }
    }
    createDivWithClass(className){
        let div=document.createElement('div')
        div.setAttribute('class',className)
        return div
    }
    
    get slideToScroll(){
        return this.isMobile? 1 :this.options.slideToScroll
    }
    
    get slideToVisible(){
        return this.isMobile? 1 :this.options.slideToVisible
    }
}
let onready=function(){
    new Carousel(document.querySelector('#carousel1'),{
        slideToVisible:3,
        slideToScroll:2,
        loop:true,
        pagination:true
    })
}
if(document.readyState!=='loading'){
    onready()
}
document.addEventListener('DOMContentLoaded',onready)

