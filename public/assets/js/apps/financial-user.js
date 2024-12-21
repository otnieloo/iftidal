document.querySelector("#inputSearchFinancial").addEventListener("keyup", CORE.delay(function() {
  Livewire.emit("set_keyword", document.querySelector("#inputSearchFinancial").value);
  Livewire.emit("set_keyword_withdraw", document.querySelector("#inputSearchFinancial").value);
}, 1000));

async function topUpWallet() {
  CORE.showLoadAdmin();
  const amount = document.querySelector(`[name="amount"]`).value;

  const request = await fetch(`/user/wallet`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      Accept: "application/json",
      "X-CSRF-TOKEN": CORE.csrfToken,
    },
    body: JSON.stringify({
      amount: amount,
    }),
  });

  CORE.removeLoadAdmin();
  if (request.status == 200) {
    const response = await request.json();
    document.querySelector(`#jwtPaymentTopUp`).value = response.data;
    document.querySelector(`#formTopupWalletPG`).submit();
  } else {
    CORE.sweet("error", "Fails!", "Failed to top up wallet!");
  }
}
