function hideDiv(e) {
  var a = document.getElementById(e);
  a && (a.style.display = "none")
}
function showDiv(e) {
  div_node = document.getElementById(e),
  div_node && (div_node.style.display = "block")
}
function toggleShowPassword(e) {
  var a = document.getElementById(e);
  "password" === a.type ? (a.type = "text",
  hideDiv("eye-closed"),
  showDiv("eye-open")) : (a.type = "password",
  hideDiv("eye-open"),
  showDiv("eye-closed"))
}
