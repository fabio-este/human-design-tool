$(document).ready(function () {
  var documentRef = documentRef || document;
  var toc = documentRef.getElementById("toc");
  var headings = [].slice.call(
    documentRef.body.querySelectorAll("h1, h2, h3, h4, h5, h6")
  );

  var buttonList = [];
  headings.forEach(function (heading, index) {
    var anchor = documentRef.createElement("a");
    anchor.setAttribute("name", "toc" + index);
    anchor.setAttribute("id", "toc" + index);

    var link = documentRef.createElement("a");
    link.setAttribute("href", "#toc" + index);
    link.textContent = heading.textContent;

    var div = documentRef.createElement("div");
    div.setAttribute("class", heading.tagName.toLowerCase());

    if (heading.tagName.toLowerCase() === "h1") {
      var button = documentRef.createElement("a");
      button.setAttribute("href", "#toc" + index);
      button.classList.add("btn");

      var buttonTextContent = heading.textContent;
      var buttonText = buttonTextContent;
      console.log(buttonText);

      var number = buttonText.match(/(\d+)/);

      if (number !== null && number[0] !== undefined) {
        button.textContent = "E " + number[0];

        var buttonListItem = documentRef.createElement("li");
        buttonListItem.append(button);

        console.log(buttonListItem);
        buttonList.push(buttonListItem);
      }
    }

    div.appendChild(link);
    toc.appendChild(div);
    heading.parentNode.insertBefore(anchor, heading);
  });

  var buttonListHTML = documentRef.createElement("ul");
  buttonListHTML.classList.add("button-list");
  console.log(buttonListHTML);
  buttonList.forEach(function (listItem) {
    console.log(listItem);
    buttonListHTML.append(listItem);
  });

  console.log(buttonListHTML);

  toc.prepend(buttonListHTML);
});
