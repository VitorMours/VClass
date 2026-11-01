package com.vclass.skynda.qrcode.infrastructure.configuration;

import io.swagger.v3.oas.annotations.OpenAPIDefinition;
import io.swagger.v3.oas.annotations.info.Info;
import org.springframework.context.annotation.Configuration;

@Configuration
@OpenAPIDefinition(
    info = @Info(
        title = "Microsserviço de Geração de QR Code",
        version = "v1.0",
        description = "Documentação da API REST para geração de QR Codes utilizando Clean Architecture e ZXing."
    )
)
public class OpenApiConfiguration {
    // Essa classe apenas carrega as anotações globais do OpenAPI no contexto do Spring
}