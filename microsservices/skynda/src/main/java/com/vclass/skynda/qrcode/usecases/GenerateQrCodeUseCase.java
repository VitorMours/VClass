package com.vclass.skynda.qrcode.usecases;

import com.vclass.skynda.qrcode.domain.gateway.QrCodeGeneratorGateway;
import com.vclass.skynda.qrcode.domain.model.QrCode;

public class GenerateQrCodeUseCase {

    private final QrCodeGeneratorGateway gateway;
    
    public GenerateQrCodeUseCase(QrCodeGeneratorGateway gateway) {
        this.gateway = gateway;
    }


    public QrCode call(String content, int size) {
        QrCode qrCode = new QrCode(content, size);

        byte[] imageBytes = gateway.generate(qrCode.getContent(), qrCode.getSize());
        qrCode.setImageBytes(imageBytes);

        return qrCode;
    }
    
}
