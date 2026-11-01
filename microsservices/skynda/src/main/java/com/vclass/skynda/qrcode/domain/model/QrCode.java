package com.vclass.skynda.qrcode.domain.model;

public class QrCode {

    private final String content;
    private byte[] imageBytes;
    private final int size;

    public QrCode(String content, int size) {
        this.content = content;
        this.imageBytes = null;
        this.size = size;
    }
    
    public String getContent() { return content; }
    public byte[] getImageBytes() { return imageBytes; }
    public int getSize() { return size; }
    
    public void setImageBytes(byte[] imageBytes) {
        this.imageBytes = imageBytes;
    }
}
