// JavaScript Document
function _(el)
{
	return document.getElementById(el);
}
function toggleElement(elem)
{
	if(_(elem).style.display=="block")
	{
		_(elem).style.display="none";
	}
	else
	{
		_(elem).style.display="block";
	}
}