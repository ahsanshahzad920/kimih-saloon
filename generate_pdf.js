const { execSync } = require('child_process');
const path = require('path');
const fs = require('fs');

const htmlPath = path.resolve(__dirname, 'Kimih_Project_Documentation.html');
const pdfPath = path.resolve(__dirname, 'Kimih_Project_Documentation.pdf');

const edgePaths = [
    'C:\\Program Files (x86)\\Microsoft\\Edge\\Application\\msedge.exe',
    'C:\\Program Files\\Microsoft\\Edge\\Application\\msedge.exe'
];

let edgePath = edgePaths.find(p => fs.existsSync(p));

if (edgePath) {
    const cmd = `"${edgePath}" --headless --disable-gpu --no-pdf-header-footer --print-to-pdf="${pdfPath}" "file:///${htmlPath.replace(/\\/g, '/')}"`;
    console.log("Running command:", cmd);
    execSync(cmd);
    if (fs.existsSync(pdfPath)) {
        console.log("SUCCESS! PDF created at:", pdfPath, "Size:", fs.statSync(pdfPath).size, "bytes");
    } else {
        console.log("PDF not created yet");
    }
} else {
    console.log("Edge executable not found");
}
