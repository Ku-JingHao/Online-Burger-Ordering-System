let popout = document.getElementById("popout");
				
function openPopout(){
	popout.classList.add("open-popout");
					
}
				
let closeCart = document.querySelector("#close-icon");
closeCart.onclick = () =>
{
	popout.classList.remove("open-popout");
};