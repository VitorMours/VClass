package com.vclass.skynda.qrcode.infrastructure.configuration;

import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;

import com.vclass.skynda.qrcode.adapter.out.qrcode.QrCodeGenerator;
import com.vclass.skynda.qrcode.domain.gateway.QrCodeGeneratorGateway;
import com.vclass.skynda.qrcode.usecases.GenerateQrCodeUseCase;

@Configuration
public class BeanConfiguration {

    @Bean
    public QrCodeGeneratorGateway qrCodeGeneratorGateway() {
        return new QrCodeGenerator();
    }

    @Bean
    public GenerateQrCodeUseCase generateQRCodeUseCase(QrCodeGeneratorGateway gateway) {
        return new GenerateQrCodeUseCase(gateway);
    }
}