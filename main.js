
document.addEventListener("DOMContentLoaded", () => {
  const voteButtons = document.querySelectorAll(".vote-button");
  voteButtons.forEach(btn => {
    btn.addEventListener("click", () => {
      alert("Thank you for voting TotemRush!");
    });
  });
});
