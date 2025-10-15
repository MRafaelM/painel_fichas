document.querySelectorAll(".btn.inativar, .btn.ativar").forEach(btn => {
  btn.addEventListener("click", (e) => {
    const card = e.target.closest(".card");
    const secretaria = card.querySelector("h3").textContent;

    if (btn.classList.contains("inativar")) {
      card.classList.remove("ativa");
      card.classList.add("inativa");
      card.querySelector(".status").textContent = "Inativa";
      card.querySelector(".status").className = "status inativa";
      btn.textContent = "Ativar";
      btn.classList.remove("inativar");
      btn.classList.add("ativar");
      alert(`Secretaria "${secretaria}" foi inativada.`);
    } else {
      card.classList.remove("inativa");
      card.classList.add("ativa");
      card.querySelector(".status").textContent = "Ativa";
      card.querySelector(".status").className = "status ativa";
      btn.textContent = "Inativar";
      btn.classList.remove("ativar");
      btn.classList.add("inativar");
      alert(`Secretaria "${secretaria}" foi ativada.`);
    }
  });
});
