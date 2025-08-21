<?php
session_start();

if (!isset($_SESSION['order'])) {
    header("Location: shop.php");
    exit;
}

$order = $_SESSION['order'];
// Optionally clear the session after showing invoice
// unset($_SESSION['order']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Order Invoice</title>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Roboto&display=swap');

  /* Reset and base */
  *, *::before, *::after {
    box-sizing: border-box;
  }

  body {
    margin: 0; 
    padding: 50px 24px;
    font-family: 'Roboto', sans-serif;
    background: linear-gradient(135deg, #f0f4f8, #d9e2ec);
    display: flex;
    flex-direction: column;
    align-items: center;
    min-height: 100vh;
    color: #1e2a38;
  }

  .invoice-container {
    background: #ffffff;
    width: 100%;
    max-width: 960px;
    border-radius: 18px;
    box-shadow: 0 14px 48px rgba(30, 42, 56, 0.15);
    overflow: hidden;
    animation: fadeSlideUp 0.9s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    display: flex;
    flex-direction: column;
    user-select: none;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .invoice-container:hover {
    transform: translateY(-6px) scale(1.01);
    box-shadow: 0 24px 60px rgba(30, 42, 56, 0.3);
  }

  @keyframes fadeSlideUp {
    from {
      opacity: 0;
      transform: translateY(30px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .invoice-header {
    background: linear-gradient(90deg, #2f497f, #40639a);
    color: #f0f4f8;
    padding: 56px 36px 28px;
    text-align: center;
    font-family: 'Montserrat', sans-serif;
    font-weight: 700;
    font-size: 38px;
    letter-spacing: 5px;
    box-shadow: inset 0 -5px 8px rgba(255,255,255,0.1);
    user-select: text;
    transition: background-color 0.4s ease;
    position: relative;
  }

  .invoice-header:hover {
    background: linear-gradient(90deg, #24406a, #335582);
  }

  .invoice-date {
    margin-top: 14px;
    font-weight: 400;
    font-size: 15px;
    color: #aac4e7;
    letter-spacing: 2.2px;
    user-select: text;
  }

  .invoice-time {
    margin-top: 4px;
    font-weight: 500;
    font-size: 17px;
    color: #d0d9f2;
    letter-spacing: 2.2px;
    font-family: 'Roboto', sans-serif;
    user-select: text;
  }

  table.invoice-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 14px;
    margin: 52px 64px 64px;
    font-size: 18px;
    color: #344054;
  }

  table.invoice-table th,
  table.invoice-table td {
    padding: 14px 20px;
    background: #f9fafb;
    border-radius: 8px;
    vertical-align: middle;
    transition: background-color 0.25s ease, transform 0.25s ease;
  }

  table.invoice-table th {
    text-align: left;
    font-family: 'Montserrat', sans-serif;
    font-weight: 700;
    color: #52606d;
    letter-spacing: 0.07em;
    text-transform: uppercase;
  }

  table.invoice-table td {
    font-weight: 600;
    color: #1c1f23;
    max-width: 60%;
    word-break: break-word;
  }

  table.invoice-table tbody tr:hover td {
    background-color: #e3ebf9;
    transform: translateX(5px);
    color: #1e3a8a;
  }

  table.invoice-table tbody tr.total-row td {
    background: #40639a;
    color: #fff;
    font-size: 22px;
    font-weight: 900;
    letter-spacing: 0.1em;
  }

  button#download-btn {
    margin-top: auto;
    background: linear-gradient(90deg, #40639a, #5c7fcf);
    color: white;
    border: none;
    padding: 26px 0;
    font-size: 24px;
    font-weight: 800;
    border-radius: 0 0 18px 18px;
    cursor: pointer;
    box-shadow: 0 10px 28px rgba(64, 99, 154, 0.7);
    transition: background 0.45s ease, box-shadow 0.45s ease, transform 0.3s ease;
  }

  button#download-btn:hover {
    background: linear-gradient(90deg, #2f497f, #40639a);
    box-shadow: 0 14px 38px rgba(47, 73, 127, 0.85);
    transform: scale(1.05);
  }

  .path-msg {
    margin-top: 28px;
    font-size: 15px;
    color: #52606d;
    font-family: 'Roboto', sans-serif;
    letter-spacing: 1.3px;
    user-select: text;
    text-align: center;
  }

  @media (max-width: 780px) {
    body {
      padding: 30px 16px;
    }

    table.invoice-table {
      margin: 36px 24px 40px;
      font-size: 16px;
    }

    table.invoice-table th, table.invoice-table td {
      padding: 12px 14px;
    }

    .invoice-header {
      font-size: 28px;
      padding: 40px 24px 20px;
      letter-spacing: 3px;
    }

    button#download-btn {
      padding: 20px 0;
      font-size: 20px;
    }
  }
</style>
</head>
<body>

<div class="invoice-container" id="invoice">
  <div class="invoice-header">
    Order Invoice
    <div class="invoice-date">
      <?php echo date('F j, Y'); ?>
    </div>
    <div class="invoice-time" id="current-time">
      <!-- time will be inserted here by JS -->
    </div>
  </div>

  <table class="invoice-table" role="table" aria-label="Order Invoice Details">
    <tbody>
      <tr>
        <th scope="row">Product Name:</th>
        <td><?php echo htmlspecialchars($order['product_name']); ?></td>
      </tr>
      <tr>
        <th scope="row">Price per Unit:</th>
        <td>₹<?php echo number_format($order['price'], 2); ?></td>
      </tr>
      <tr>
        <th scope="row">Quantity:</th>
        <td><?php echo (int)$order['quantity']; ?></td>
      </tr>
      <tr class="total-row">
        <th scope="row">Total Price:</th>
        <td>₹<?php echo number_format($order['total_price'], 2); ?></td>
      </tr>
      <tr>
        <th scope="row">Full Name:</th>
        <td><?php echo htmlspecialchars($order['fullname']); ?></td>
      </tr>
      <tr>
        <th scope="row">Email:</th>
        <td><?php echo htmlspecialchars($order['email']); ?></td>
      </tr>
      <tr>
        <th scope="row">Address:</th>
        <td><?php echo htmlspecialchars($order['address']); ?></td>
      </tr>
      <tr>
        <th scope="row">Mobile Number:</th>
        <td><?php echo htmlspecialchars($order['m_number']); ?></td>
      </tr>
      <tr>
        <th scope="row">City:</th>
        <td><?php echo htmlspecialchars($order['city']); ?></td>
      </tr>
      <tr>
        <th scope="row">State:</th>
        <td><?php echo htmlspecialchars($order['state']); ?></td>
      </tr>
      <tr>
        <th scope="row">Pincode:</th>
        <td><?php echo htmlspecialchars($order['pincode']); ?></td>
      </tr>
      <tr>
        <th scope="row">Payment Method:</th>
        <td><?php echo htmlspecialchars(ucwords($order['payment_method'])); ?></td>
      </tr>
    </tbody>
  </table>

  <button id="download-btn">Download Invoice as PDF</button>
</div>

<div class="path-msg">
 <a href="Home.php">@pathofPunay.org</a>
</div>

<!-- jsPDF library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
  // Update live time every second
  function updateTime() {
    const timeEl = document.getElementById('current-time');
    const now = new Date();
    const options = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
    timeEl.textContent = now.toLocaleTimeString('en-IN', options);
  }
  setInterval(updateTime, 1000);
  updateTime();

  const { jsPDF } = window.jspdf;

  // Helper function to split long text into lines fitting within max width
  function splitTextToSize(doc, text, maxWidth) {
    return doc.splitTextToSize(text, maxWidth);
  }

  document.getElementById('download-btn').addEventListener('click', () => {
    const doc = new jsPDF('p', 'mm', 'a4');
    const pageWidth = doc.internal.pageSize.getWidth();
    const pageHeight = doc.internal.pageSize.getHeight();
    const margin = 20;
    let cursorY = 20;
    const lineHeight = 8;

    // Title
    doc.setFontSize(22);
    doc.setTextColor('#40639a');
    doc.text("Order Invoice", pageWidth / 2, cursorY, null, null, 'center');
    cursorY += 10;

    // Date & time
    doc.setFontSize(12);
    doc.setTextColor('#2f497f');
    const currentDate = new Date().toLocaleDateString('en-IN', { year: 'numeric', month: 'long', day: 'numeric' });
    const currentTime = new Date().toLocaleTimeString('en-IN', { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false });
    doc.text(`${currentDate} - ${currentTime}`, pageWidth / 2, cursorY, null, null, 'center');
    cursorY += 15;

    // Data to print: label and value
    const data = [
      ['Product Name:', '<?php echo addslashes($order['product_name']); ?>'],
      ['Price per Unit:', '₹<?php echo number_format($order['price'], 2); ?>'],
      ['Quantity:', '<?php echo (int)$order['quantity']; ?>'],
      ['Total Price:', '₹<?php echo number_format($order['total_price'], 2); ?>'],
      ['Full Name:', '<?php echo addslashes($order['fullname']); ?>'],
      ['Email:', '<?php echo addslashes($order['email']); ?>'],
      ['Address:', `<?php echo addslashes($order['address']); ?>`],
      ['Mobile Number:', '<?php echo addslashes($order['m_number']); ?>'],
      ['City:', '<?php echo addslashes($order['city']); ?>'],
      ['State:', '<?php echo addslashes($order['state']); ?>'],
      ['Pincode:', '<?php echo addslashes($order['pincode']); ?>'],
      ['Payment Method:', '<?php echo addslashes(ucwords($order['payment_method'])); ?>']
    ];

    doc.setFontSize(14);
    doc.setTextColor('#000');
    const labelX = margin;
    const valueX = pageWidth - margin;

    data.forEach(([label, value]) => {
      // Check for page break
      if (cursorY + lineHeight * 2 > pageHeight - margin) {
        doc.addPage();
        cursorY = margin;
      }

      // Draw label (bold)
      doc.setFont(undefined, 'bold');
      doc.text(label, labelX, cursorY);

      // Draw value (normal) with wrapping if needed
      doc.setFont(undefined, 'normal');
      const maxValueWidth = valueX - labelX - 30; // allow space for label and padding
      const splitValue = splitTextToSize(doc, value, maxValueWidth);

      // If multiple lines for value, print them line by line right aligned
      if (splitValue.length === 1) {
        doc.text(splitValue[0], valueX, cursorY, { align: 'right' });
        cursorY += lineHeight;
      } else {
        // first line aligned right at cursorY
        doc.text(splitValue[0], valueX, cursorY, { align: 'right' });
        cursorY += lineHeight;
        // subsequent lines aligned right with smaller indent
        for (let i = 1; i < splitValue.length; i++) {
          if (cursorY + lineHeight > pageHeight - margin) {
            doc.addPage();
            cursorY = margin;
          }
          doc.text(splitValue[i], valueX, cursorY, { align: 'right' });
          cursorY += lineHeight;
        }
      }
    });

    doc.save('invoice.pdf');
  });
</script>

</body>
</html>
