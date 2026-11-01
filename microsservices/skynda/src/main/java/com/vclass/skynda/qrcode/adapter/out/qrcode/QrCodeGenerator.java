package com.vclass.skynda.qrcode.adapter.out.qrcode;

import java.io.ByteArrayOutputStream;
import java.io.IOException;

import com.google.zxing.BarcodeFormat;
import com.google.zxing.WriterException;
import com.google.zxing.client.j2se.MatrixToImageWriter;
import com.google.zxing.qrcode.QRCodeWriter;
import com.vclass.skynda.qrcode.domain.gateway.QrCodeGeneratorGateway;

public class QrCodeGenerator implements QrCodeGeneratorGateway {

    @Override
    public byte[] generate(String content, int size) {
        try {
            var matrix = new QRCodeWriter().encode(content, BarcodeFormat.QR_CODE, size, size);
            var output = new ByteArrayOutputStream();
            MatrixToImageWriter.writeToStream(matrix, "PNG", output);
            return output.toByteArray();
        } catch (WriterException | IOException exception) {
            throw new IllegalStateException("Failed to generate QR code image", exception);
        }
    }
}
