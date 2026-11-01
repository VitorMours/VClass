package com.vclass.skynda.qrcode.domain.gateway;

public interface QrCodeGeneratorGateway {
    byte[] generate(String content, int size);
}
