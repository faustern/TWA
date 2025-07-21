// 22120123 - Long Nguyen - Practical 15:00 -> 17:00

// check for empty input
function checkEmptyInput (inputItem) { 
  let length = inputItem.value.length; 
  if (length == 0) { 
    inputItem.style.background = "#ffb3b3"; 
  } else { 
    inputItem.style.background = "#e6f9ff"; 
  } 
}

//on load
window.onload = function () {
  // fill date

  const currentDate = document.getElementById("quoteDate");
  const today = new Date();
  const month = String(today.getMonth() + 1).padStart(2, '0');
  const day = String(today.getDate()).padStart(2, '0');
  const year = today.getFullYear();
  
  currentDate.value = `${day}-${month}-${year}`;

  //JavaScript Get Current Date – Today's Date in JS
  //https://www.freecodecamp.org/news/javascript-get-current-date-todays-date-in-js/

  //calc line total
  for (let i = 1; i <= 5; i++) {
    const qty = document.querySelector(`input[name=product${i}_qty]`);
    const price = document.querySelector(`input[name=product${i}_price]`);

    if (qty && price) {
      qty.addEventListener('input', () => calculateLineTotal(i));
      price.addEventListener('input', () => calculateLineTotal(i));
    }
  }

  // calc deposit
  const depositInput = document.getElementById("depositPaid");
  if (depositInput) {
    depositInput.addEventListener("input", updateSummaryTotals);
  }
};

// line total setup
function calculateLineTotal(i) {
  const qty = document.querySelector(`input[name=product${i}_qty]`);
  const price = document.querySelector(`input[name=product${i}_price]`);
  const total = document.querySelector(`input[name=product${i}_total]`);

  if (qty && price && total) {
    const qtyVal = parseInt(qty.value);
    const priceVal = parseFloat(price.value);
    if (!isNaN(qtyVal) && !isNaN(priceVal)) {
      total.value = (qtyVal * priceVal).toFixed(2);
    } else {
      total.value = '';
    }

    updateSummaryTotals()
  }
}

//update payment
function updateSummaryTotals() {
  let subtotal = 0;

  for (let i = 1; i <= 5; i++) {
    const lineTotalInput = document.querySelector(`input[name=product${i}_total]`);
    if (lineTotalInput && lineTotalInput.value.trim()) {
      const lineValue = parseFloat(lineTotalInput.value);
      if (!isNaN(lineValue)) {
        subtotal += lineValue;
      }
    }
  }

  const gst = subtotal * 0.10;
  const total = subtotal + gst;

  const depositInput = document.getElementById("depositPaid");
  let deposit = parseFloat(depositInput?.value);
  if (isNaN(deposit) || deposit < 0) {
    deposit = 0;
  }
  const validDeposit = deposit;
  const totalDue = total - validDeposit;

  document.getElementById("subtotal").value = subtotal.toFixed(2);
  document.getElementById("gst").value = gst.toFixed(2);
  document.getElementById("total").value = total.toFixed(2);
  document.getElementById("totalDue").value = totalDue.toFixed(2);
}

// check form upon submit
document.querySelector("form").addEventListener("submit", function (e) {
  let isValid = true;

  const staffno = document.getElementById("staffno");
  const title = document.getElementById("title");
  const lname = document.getElementById("lname");
  const phone = document.getElementById("phone");
  const email = document.getElementById("email");

  // staff no. check
  if (staffno.value.trim() !== "") {
    if (!/^\d+$/.test(staffno.value.trim()))  {
      alert("Staff No. must contain digits only.");
      title.style.background = "#ffb3b3";
      staffno.focus();
      isValid = false;
    }
  }

  //title check
  if (title.value.trim() === "None") {
    alert("Customer title is required.");
    title.style.background = "#ffb3b3";
    title.focus();
    isValid = false;
  } else {
    title.style.background = "#e6f9ff";
  }

  //surname check
  if (lname.value.trim() === "") {
    alert("First name is required.");
    lname.focus();
    isValid = false;
  }

  //phone number check
  if (!/^\d+$/.test(phone.value.trim())) {
    alert("Phone number must contain digits only.");
    phone.focus();
    isValid = false;
  } else if (!/^\d{10}$/.test(phone.value.trim())) {
    alert("Phone number must be exactly 10 digits.");
    phone.focus();
    isValid = false;
  }

  //email check
  if (email.value.trim() !== "") {
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value.trim())) {
      alert("Please enter a valid email address.");
      title.style.background = "#ffb3b3";
      email.focus();
      isValid = false;
    }
  }

  //check deposit paid
  const deposit = parseFloat(document.getElementById("depositPaid")?.value);
  if (isNaN(deposit) || deposit < 0) {
    alert("Deposit Paid must be a number greater than or equal to 0.");
    document.getElementById("depositPaid").style.background = "#ffb3b3";
    document.getElementById("depositPaid").focus();
    isValid = false;
  } else {
    document.getElementById("depositPaid").style.background = "#e6f9ff";
  }

  //check if at least one product is entered
  let oneProduct = false;
  for (let i = 1; i <= 5; i++) {
    const id = document.querySelector(`input[name=product${i}_id]`);
    const desc = document.querySelector(`input[name=product${i}_desc]`);
    const qty = document.querySelector(`input[name=product${i}_qty]`);
    const price = document.querySelector(`input[name=product${i}_price]`);

    if ((id && id.value.trim()) || (desc && desc.value.trim()) || (qty && qty.value.trim()) || (price && price.value.trim())) {
      oneProduct = true;
      break;
    }
  }

  if (!oneProduct) {
    alert("Please enter at least one product.");
    isValid = false;
  }

  //product check
  for (let i = 1; i <= 5; i++) {
    const id = document.querySelector(`input[name=product${i}_id]`);
    const desc = document.querySelector(`input[name=product${i}_desc]`);
    const qty = document.querySelector(`input[name=product${i}_qty]`);
    const price = document.querySelector(`input[name=product${i}_price]`);

    // If fields empty, skip row
    if (!id.value && !desc.value && !qty.value && !price.value) {
      continue
    };

    if (!id.value.trim()) {
      alert(`Product ${i} ID is required.`);
      id.style.background = "#ffb3b3";
      id.focus();
      isValid = false;
      break;
    } else {
      id.style.background = "#e6f9ff";
    }

    if (!desc.value.trim()) {
      alert(`Product ${i} description is required.`);
      desc.style.background = "#ffb3b3";
      desc.focus();
      isValid = false;
      break;
    } else {
      desc.style.background = "#e6f9ff";
    }

    if (!/^\d+$/.test(qty.value.trim()) || parseInt(qty.value) <= 0) {
      alert(`Product ${i} quantity must be a positive whole number.`);
      qty.style.background = "#ffb3b3";
      qty.focus();
      isValid = false;
      break;
    } else {
      qty.style.background = "#e6f9ff";
    }

    if (!/^\d*\.?\d+$/.test(price.value.trim()) || parseFloat(price.value) <= 0) {
      alert(`Product ${i} unit price must be a positive number.`);
      price.style.background = "#ffb3b3";
      price.focus();
      isValid = false;
      break;
    } else {
      price.style.background = "#e6f9ff";
    }
  }

  // Stop if input invalid
  if (!isValid) {
    e.preventDefault();
  }
});