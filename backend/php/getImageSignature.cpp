#include <stdio.h>

#pragma pack(1)

#include <iostream>
#include <fstream>
#include <vector>
#include <algorithm>
#include <string.h> // memset

using namespace std;

//  based on:  https://gist.github.com/BrainUser/80a4e12f8ae535499243
/**
 * bmp.h part of resize.c
 *
 * Computer Science 50
 * Problem Set 5
 *
 * BMP-related data types based on Microsoft's own.
 */

#include <stdint.h>

/**
 * Common Data Types 
 *
 * The data types in this section are essentially aliases for C/C++ 
 * primitive data types.
 *
 * Adapted from http://msdn.microsoft.com/en-us/library/cc230309.aspx.
 * See http://en.wikipedia.org/wiki/Stdint.h for more on stdint.h.
 */
typedef uint8_t  BYTE;
typedef uint32_t DWORD;
typedef int32_t  LONG;
typedef uint16_t WORD;

/**
 * BITMAPFILEHEADER
 *
 * The BITMAPFILEHEADER structure contains information about the type, size,
 * and layout of a file that contains a DIB [device-independent bitmap].
 *
 * Adapted from http://msdn.microsoft.com/en-us/library/dd183374(VS.85).aspx.
 */
typedef struct 
{ 
    WORD   bfType; 
    DWORD  bfSize; 
    WORD   bfReserved1; 
    WORD   bfReserved2; 
    DWORD  bfOffBits; 
} __attribute__((__packed__)) 
BITMAPFILEHEADER, *PBITMAPFILEHEADER; 

/**
 * BITMAPINFOHEADER
 *
 * The BITMAPINFOHEADER structure contains information about the 
 * dimensions and color format of a DIB [device-independent bitmap].
 *
 * Adapted from http://msdn.microsoft.com/en-us/library/dd183376(VS.85).aspx.
 */
typedef struct
{
    DWORD  biSize; 
    LONG   biWidth; 
    LONG   biHeight; 
    WORD   biPlanes; 
    WORD   biBitCount; 
    DWORD  biCompression; 
    DWORD  biSizeImage; 
    LONG   biXPelsPerMeter; 
    LONG   biYPelsPerMeter; 
    DWORD  biClrUsed; 
    DWORD  biClrImportant; 
} __attribute__((__packed__))
BITMAPINFOHEADER, *PBITMAPINFOHEADER; 

/**
 * RGBTRIPLE
 *
 * This structure describes a color consisting of relative intensities of
 * red, green, and blue.
 *
 * Adapted from http://msdn.microsoft.com/en-us/library/aa922590.aspx.
 */
typedef struct
{
    BYTE  rgbtBlue;
    BYTE  rgbtGreen;
    BYTE  rgbtRed;
} __attribute__((__packed__))
RGBTRIPLE;

//  based on:  https://gist.github.com/BrainUser/80a4e12f8ae535499243
BITMAPFILEHEADER bf;
BITMAPINFOHEADER bi;
BYTE *buffer = 0;
BYTE *hslbuf = 0;
int bmWidthBytes = 0;

int read_bmp_file(const char *infile)
{
    // open input file
    FILE *inptr = fopen(infile, "r");
    if (inptr == NULL)
    {
        printf("Could not open %s.", infile);
        return 2;
    }
 
    // read infile's BITMAPFILEHEADER
    fread(&bf, sizeof (BITMAPFILEHEADER), 1, inptr);
 
    // read infile's BITMAPINFOHEADER
    fread(&bi, sizeof (BITMAPINFOHEADER), 1, inptr);
 
    // int padding = (4 - (bi.biWidth * sizeof (RGBTRIPLE)) % 4) % 4;
    //bmWidthBytes = bi.biWidth + padding;
    bmWidthBytes = bi.biWidth * 3; 
    if(bmWidthBytes % 4 != 0)
        bmWidthBytes = bmWidthBytes + (4 - (bmWidthBytes % 4));

    /*
    printf(" type = %X bits = %d bisize=%d bits = %d comp=%d widthBytes=%d w=%d h=%d ",
            bf.bfType,
            bf.bfOffBits,
            bi.biSize,
            bi.biBitCount,
            bi.biCompression,
            bmWidthBytes,
            bi.biWidth,
            bi.biHeight
        );
        */

    /*
    // ensure infile is (likely) a 24-bit uncompressed BMP 4.0. If not, quit
    if (bf.bfType != 0x4d42 || bf.bfOffBits != 54 || bi.biSize != 40 ||
                    bi.biBitCount != 24 || bi.biCompression != 0)
    {
        fclose(inptr);
        fprintf(stderr, "Unsupported file format.\n");
        return 4;
    }
    */

    buffer = new BYTE[bi.biSizeImage];
    hslbuf = new BYTE[bi.biSizeImage];
    fread(buffer, bi.biSizeImage, 1, inptr);

    /*
    int oldWidth = bi.biWidth; //save old width
    int oldHeight = bi.biHeight; // save old height
    bi.biSizeImage = abs(bi.biHeight) * ((bi.biWidth * sizeof (RGBTRIPLE)) + padding); // determine the new size of the image
    bf.bfSize = bi.biSizeImage + sizeof (BITMAPFILEHEADER) + sizeof (BITMAPINFOHEADER); // determine the new file size.
    */
 
    // close infile
    fclose(inptr);
 
    return 0;
}

#define Min(x,y) ((x<y)?(x):(y))
#define Max(x,y) ((x>y)?(x):(y))

///////////////////////////////////////////////////////////////////////////////////////////////////////
// based on https://www.rapidtables.com/convert/color/rgb-to-hsl.html
//
unsigned long RGBtoHSL(BYTE rgb[3], int x, int y) 
{
	unsigned long hsl;  // hue, saturation, lightness
	BYTE *d = (BYTE *)&hsl;
	double H, S, L;

	float r = (rgb[0] / 255.0f);
	float g = (rgb[1] / 255.0f);
	float b = (rgb[2] / 255.0f);

	float min = Min(Min(r, g), b);
	float max = Max(Max(r, g), b);
	float delta = max - min;

	L = ((max + min) / 2); // L

	if (delta == 0)
	{
		H = 0;     // H
		S = 0;  // S
	}
	else
	{
		S = (L <= 0.5) ? (delta / (max + min)) : (delta / (2 - max - min));  // S

		float hue;

		if (r == max)
		{
			hue = ((g - b) / 6) / delta;
		}
		else if (g == max)
		{
			hue = (1.0f / 3) + ((b - r) / 6) / delta;
		}
		else
		{
			hue = (2.0f / 3) + ((r - g) / 6) / delta;
		}

		if (hue < 0)
			hue += 1;
		if (hue > 1)
			hue -= 1;

		//H = (hue * 360); // H
		H = (hue * 256); // H
	}
	hsl = 0;
	d[2] = (BYTE)(DWORD)H;
	d[1] = (BYTE)(DWORD)(S * 256);
	d[0] = (BYTE)(DWORD)(L * 256);

    /*
    fprintf(stderr, "RGBtoHSL: %3d %3d  - %2x %2x %2x  -  %2x %2x %2x  \n"
                , x, y
                , rgb[0]
                , rgb[1]
                , rgb[2]
                , d[0]
                , d[1]
                , d[2]
                );
    */
	return hsl;
}

///////////////////////////////////////////////////////////////////////////////////////////////////////

int H[16]; // Hue
int L[16];
int S[16]; 

void findHSLrange()
{
	//int x0 = 0;
	//int y0 = 0;
	//int dx = bi.biWidth;
    //int dy = bi.biHeight;

	int x0 = bi.biWidth/3;
	int y0 = bi.biHeight/3;
	int dx = bi.biWidth/3;
    int dy = bi.biHeight/3;


	if(dx == 0 || dy == 0)
		return;

	BYTE *b = hslbuf;
	{
		for(int j=0; j<bi.biHeight;j++)
		{
			BYTE *s = (buffer + j * bmWidthBytes);
			BYTE *d = (b + j * bmWidthBytes);
			for(int i=0; i<bi.biWidth;i++)
			{
				unsigned long x = RGBtoHSL(s,i,j);
                BYTE *y = (BYTE *)&x;
                d[0] = y[2];
                d[1] = y[1];
                d[2] = y[0];
				s+=3;
				d+=3;
			}
		}
	}

	b = b + bmWidthBytes * y0;

	memset(H, 0, sizeof H);
	memset(L, 0, sizeof L);
	memset(S, 0, sizeof S);

	for(int j=0;j<dy;j++)
	{
		for(int i=0;i<dx;i++)
		{
			BYTE *c = (BYTE*)(b+j*bmWidthBytes+(x0+i)*3);

			int hue01 = c[2] / 0x10;
			int light = c[0] / 0x10;
			int sssss = c[1] / 0x10;

			H[hue01] ++;
			L[light] ++;
			S[sssss] ++;
		}
	}
    int hh[16];

    for(int i=0;i<16;i++)
        hh[i] = H[i];
    sort(hh, hh + 16);

    int mid = hh[7];
    int top = hh[15];
    if(mid == 0)
        mid = 1;

    printf("data: %d,  ", mid);
    for(int i=0;i<16;i++)
    {
        /*
        if(H[i] == top)
            printf("0, ");
        else
        */        
            printf("%d,",H[i] );
    }
    printf("  S,");
    for(int i=0;i<16;i++)
    {
        printf("%d,",L[i] );
    }
    printf("  L,");
    for(int i=0;i<16;i++)
    {
        printf("%d,",S[i] );
    }
    printf(" B, %d, W, %d, H, %d, b, %d", bmWidthBytes,bi.biWidth, bi.biHeight, bi.biBitCount);
}

///////////////////////////////////////////////////////////////////////////////////////////////////////

int main(int argc, char **argv)
{
    if(argc<2)
    {
        printf(" File not found.");
        return 1;
    }

    if(read_bmp_file(argv[1]))
    {
        printf("file = %s ", argv[1]);
        return 2;
    }
    findHSLrange();

    return 0;
}
