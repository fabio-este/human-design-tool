/**
 * Automatically create a Table Of Contents in the Report View
 */
$(document).ready(function () {
  let documentRef = documentRef || document;
  let toc = documentRef.getElementById("toc");
  let headings = [].slice.call(documentRef.body.querySelectorAll("h1, h2, h3"));
  let tocToggle = documentRef.getElementById("toggle-toc-button");

  tocToggle.click(function () {
    toc.classList.add("hide");
  });
  $(tocToggle).on("click", function () {
    $(toc).toggle("slow", function () {
      // Animation complete.
    });
  });

  /**
   * Parse Headers
   */
  let buttonList = [];
  headings.forEach(function (heading, index) {
    // skip if this header is hidden via the 'data-toc-hide="1"' tag
    let tocHide = $(heading).data("toc-hide") === 1;
    if (tocHide) return;

    let anchor = documentRef.createElement("a");
    anchor.setAttribute("name", "toc" + index);
    anchor.setAttribute("id", "toc" + index);

    let link = documentRef.createElement("a");
    link.setAttribute("href", "#toc" + index);
    link.textContent = heading.textContent.split(" - ")[0];

    let div = documentRef.createElement("div");
    div.setAttribute("class", heading.tagName.toLowerCase());

    // Create button menu from H1 Tags
    if (heading.tagName.toLowerCase() === "h1") {
      let button = documentRef.createElement("a");
      button.setAttribute("href", "#toc" + index);
      button.classList.add("btn");

      let buttonTextContent = heading.textContent;
      let buttonText = buttonTextContent;

      let number = buttonText.match(/(\d+)/);

      if (number !== null && number[0] !== undefined) {
        button.textContent = "E " + number[0];

        let buttonListItem = documentRef.createElement("li");
        buttonListItem.append(button);
        buttonList.push(buttonListItem);
      }
    }

    div.appendChild(link);
    toc.appendChild(div);
    heading.parentNode.insertBefore(anchor, heading);
  });

  // Build button list
  let buttonListHTML = documentRef.createElement("ul");
  buttonListHTML.classList.add("button-list");

  buttonList.forEach(function (listItem) {
    buttonListHTML.append(listItem);
  });

  toc.prepend(buttonListHTML);
});
