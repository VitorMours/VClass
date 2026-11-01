package com.vclass.skynda.qrcode.adapter.in.web;

import org.springframework.http.HttpHeaders;
import org.springframework.http.MediaType;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import com.vclass.skynda.qrcode.domain.model.QrCode;
import com.vclass.skynda.qrcode.usecases.GenerateQrCodeUseCase;

import io.swagger.v3.oas.annotations.Operation;
import io.swagger.v3.oas.annotations.Parameter;
import io.swagger.v3.oas.annotations.media.Content;
import io.swagger.v3.oas.annotations.media.Schema;
import io.swagger.v3.oas.annotations.responses.ApiResponse;
import io.swagger.v3.oas.annotations.responses.ApiResponses;
import io.swagger.v3.oas.annotations.tags.Tag;

@RestController
@RequestMapping("/api/v1/qrcodes")
@CrossOrigin(origins = "*")
@Tag(name = "QR Code", description = "Endpoints para geração de QR Codes")
public class QRCodeController {

    private final GenerateQrCodeUseCase generateQRCodeUseCase;

    public QRCodeController(GenerateQrCodeUseCase generateQRCodeUseCase) {
        this.generateQRCodeUseCase = generateQRCodeUseCase;
    }

    @Operation(
        summary = "Gera uma imagem de QR Code", 
        description = "Recebe um texto ou URL e um tamanho opcional, retornando a imagem gerada em formato PNG."
    )
    @ApiResponses(value = {
        @ApiResponse(
            responseCode = "200", 
            description = "QR Code gerado com sucesso", 
            content = @Content(
                mediaType = "image/png", 
                schema = @Schema(type = "string", format = "binary")
            )
        ),
        @ApiResponse(
            responseCode = "400", 
            description = "Parâmetros inválidos (conteúdo vazio ou tamanho excedido)", 
            content = @Content
        )
    })
    @PostMapping
    public ResponseEntity<byte[]> generate(
            @Parameter(description = "Texto ou URL que será embutido no QR Code", required = true, example = "https://github.com")
            @RequestParam String content,
            
            @Parameter(description = "Tamanho do QR Code em pixels (largura e altura). O padrão é 300.", required = false, example = "400")
            @RequestParam(required = false) Integer size) {

        QrCode qrCode = generateQRCodeUseCase.call(content, size);

        HttpHeaders headers = new HttpHeaders();
        headers.setContentType(MediaType.IMAGE_PNG);
        headers.setContentLength(qrCode.getImageBytes().length);

        return ResponseEntity.ok()
                .headers(headers)
                .body(qrCode.getImageBytes());
    }
}